#!/usr/bin/env bash
set -e

# Sync host UID and GID to www-data to avoid permission issues
if [ -n "$HOST_UID" ] && [ -n "$HOST_GID" ]; then
    echo "Updating www-data UID to $HOST_UID and GID to $HOST_GID..."
    # Using sed/awk because alpine usermod/groupmod might fail if uid/gid is in use
    sed -i "s/^www-data:x:[0-9]*:[0-9]*:/www-data:x:$HOST_UID:$HOST_GID:/" /etc/passwd
    sed -i "s/^www-data:x:[0-9]*:/www-data:x:$HOST_GID:/" /etc/group
fi

# Ensure /var/www has correct ownership
chown -R www-data:www-data /var/www/projects 2>/dev/null || true

# Execute original command
exec "$@"
