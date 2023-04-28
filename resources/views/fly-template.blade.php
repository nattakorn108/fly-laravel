# fly.toml app configuration file generated
#
# See https://fly.io/docs/reference/configuration/ for information about how to use this file.
#

app = "{{ $appName }}"
kill_signal = "SIGINT"
kill_timeout = 5
primary_region = "ams"
processes = []

[build]
  [build.args]
    NODE_VERSION = "{{ $nodeVersion }}"
    PHP_VERSION = "{{ $phpVersion }}"

[env]
  APP_ENV = "production"
  LOG_CHANNEL = "stderr"
  LOG_LEVEL = "info"
  LOG_STDERR_FORMATTER = "Monolog\\Formatter\\JsonFormatter"

[experimental]
  auto_rollback = true

[[services]]
  http_checks = []
  internal_port = 8080
  processes = ["app"]
  protocol = "tcp"
  script_checks = []
  [services.concurrency]
    hard_limit = 25
    soft_limit = 20
    type = "connections" 

  [[services.ports]]
    force_https = true
    handlers = ["http"]
    port = 80

  [[services.ports]]
    handlers = ["tls", "http"]
    port = 443

  [[services.tcp_checks]]
    grace_period = "1s"
    interval = "15s"
    restart_limit = 0
    timeout = "2s"
