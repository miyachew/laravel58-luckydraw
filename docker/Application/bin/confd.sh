#!/bin/sh
set -e

echo '> Running confd...'
confd -onetime -backend env