#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" <<-EOSQL
    CREATE USER oauth;
    CREATE DATABASE oauth;
    GRANT ALL PRIVILEGES ON DATABASE oauth TO oauth;
EOSQL