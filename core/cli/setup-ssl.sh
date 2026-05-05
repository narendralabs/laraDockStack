#!/bin/bash
set -e

cd "$(dirname "$0")/../.."

if ! command -v mkcert &> /dev/null; then
    echo "mkcert is not installed. Please install it first:"
    echo "  sudo apt install libnss3-tools"
    echo "  wget -O mkcert https://dl.filippo.io/mkcert/latest?for=linux/amd64"
    echo "  chmod +x mkcert"
    echo "  sudo mv mkcert /usr/local/bin/"
    echo "  mkcert -install"
    exit 1
fi

mkdir -p core/certs
echo "Generating wildcard certificate for *.localhost and localhost..."
mkcert -cert-file core/certs/devstack.pem -key-file core/certs/devstack-key.pem "*.localhost" localhost

echo "Certificates generated in core/certs"
echo "Restart the web container to apply: ./core/cli/devstack restart web"
