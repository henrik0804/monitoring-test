# Minimal Command–Job–Command Architecture

This project is a minimal example to observe how a console command can trigger a queued job, which then executes another console command. It exists purely to test this interaction in monitoring tools.

- **Scheduler orchestrator** – `app:run-scheduled-jobs`
  - Represents the scheduler process that checks user‑defined scheduled commands.
  - Decides whether any user‑defined commands should be run and dispatches background work accordingly.

- **Queue boundary** – `ProxyToCommandJob`
  - Is dispatched by the scheduler orchestrator.
  - Runs on a queue worker, forming the async boundary.
  - Inside `handle()`, it calls a second console command via `Artisan::call(...)`.

- **Downstream command** – `api:get-fun-quote`
  - Contains the actual business logic (external API call and simulated failures).
  - Is invoked only from the queued job, never directly by the scheduler orchestrator.
