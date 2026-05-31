# ACC Demo Platform Runbook (spin down / restart / rotate IP)

Operational steps for the Magento "ACC environment" VM that backs this demo. Use this when you need
to stop the VM to save cost and bring it back later for a demo.

## Environment facts

| Item | Value |
| --- | --- |
| Cloud | AWS EC2, region `us-east-2` |
| Instance ID | `i-06552521813dd0e7f` |
| Public IP (at time of writing) | `13.59.30.88` — **ephemeral, no Elastic IP** |
| Compose project dir (on the VM) | `/home/ubuntu/acc-demo/platform` |
| Containers | `magento-web` (nginx :80), `magento-app` (php-fpm), `magento-db` (mysql 8.0), `magento-opensearch` |
| Persistent data | docker named volumes `platform_db-data`, `platform_opensearch-data` |
| Repo for CI secrets | `Cognition-Partner-Workshops/ACC-demo-webapp` |

All `docker` commands below run from `/home/ubuntu/acc-demo/platform`.

## Why a restart needs extra steps

The VM has an **ephemeral public IP**. Two places hard-code that IP and both break when it changes:

- Magento `web/unsecure/base_url` — if stale, the storefront 301-redirects to the old IP and breaks.
- The GitHub Actions `VM_HOST` secret — if stale, CI Layer 2 (the real ACC build over SSH) cannot connect.

**Recommended permanent fix:** allocate an AWS **Elastic IP** and associate it with instance
`i-06552521813dd0e7f`. The IP then survives stop/start and you never touch `base_url` or `VM_HOST`
again — section 3 becomes a one-time setup. The steps below assume no Elastic IP yet.

---

## 1. Safely spin down

```bash
cd /home/ubuntu/acc-demo/platform

# Optional: pause writes cleanly first
docker exec magento-app php bin/magento maintenance:enable

# Graceful container stop (60s grace lets MySQL/OpenSearch flush cleanly)
docker compose stop -t 60

# Confirm everything is stopped
docker compose ps
```

Then stop the EC2 instance:

- AWS Console: EC2 → Instances → `i-06552521813dd0e7f` → Instance state → **Stop instance**, or
- AWS CLI (from a machine with credentials):
  ```bash
  aws ec2 stop-instances --instance-ids i-06552521813dd0e7f --region us-east-2
  ```

> **Never run `docker compose down -v`.** The entire Magento DB and search index live in the named
> volumes `platform_db-data` and `platform_opensearch-data`; `-v` deletes them and forces a full
> Magento reinstall. Plain `stop` preserves all data.

---

## 2. Safely restart

**a. Start the instance** (AWS Console → Start instance, or
`aws ec2 start-instances --instance-ids i-06552521813dd0e7f --region us-east-2`), then note the
**new public IP**.

**b. Bring the stack back.** Because we explicitly `stop`ped the containers, they will not auto-start
on boot — start them:

```bash
cd /home/ubuntu/acc-demo/platform
docker compose start          # or: docker compose up -d
sleep 30                      # give MySQL + OpenSearch time to become ready
docker compose ps
```

**c. Point Magento at the new IP** (skip if using an Elastic IP):

```bash
NEW_IP=<paste-new-public-ip>
docker exec magento-app php bin/magento config:set web/unsecure/base_url "http://${NEW_IP}/"
docker exec magento-app php bin/magento maintenance:disable
docker exec magento-app php bin/magento cache:flush
```

**d. Verify health:**

```bash
docker exec magento-opensearch curl -s http://localhost:9200/_cluster/health | grep -o '"status":"[^"]*"'
curl -s -o /dev/null -w "storefront HTTP %{http_code}\n" "http://${NEW_IP}/"
```

Expect OpenSearch `green`/`yellow` and storefront `HTTP 200`.

> `vm.max_map_count` (required by OpenSearch) is already persisted in `/etc/sysctl.d/`, so it
> survives reboots — no action needed.

---

## 3. Update the `VM_HOST` repo secret

`VM_HOST` is the VM's public IP used by CI Layer 2's SSH step. On a restart **only `VM_HOST`
changes**; `VM_USER` and `VM_SSH_KEY` stay the same.

**GitHub UI (recommended):**

1. Open `https://github.com/Cognition-Partner-Workshops/ACC-demo-webapp/settings/secrets/actions`
2. Under **Repository secrets**, click `VM_HOST` → **Update**
3. Set the value to the new IP only (e.g. `3.21.x.x` — no `http://`, no trailing slash) → **Save**

**Or via `gh` CLI** (not installed on the VM by default):

```bash
sudo apt-get install -y gh        # one-time
gh auth login                     # PAT with repo + secrets access
gh secret set VM_HOST -b "<NEW_IP>" -R Cognition-Partner-Workshops/ACC-demo-webapp
```

**Then validate CI end-to-end:** re-run the latest workflow (or push a trivial commit). Layer 2
should SSH to the new IP and run the real Magento build successfully.

---

## Quick reference — what changes on each IP rotation

| Thing | Where | New value |
| --- | --- | --- |
| Magento `base_url` | `bin/magento config:set web/unsecure/base_url` | `http://<NEW_IP>/` |
| `VM_HOST` secret | GitHub repo → Settings → Secrets → Actions | `<NEW_IP>` |
| `VM_USER` / `VM_SSH_KEY` | — | unchanged |

> Eliminate this table entirely by assigning an **Elastic IP** to the instance.
