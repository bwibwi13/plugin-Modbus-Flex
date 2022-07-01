#!/bin/bash

# Ensure required python modules are installed
python3 -m pip install pyModbusTCP
if [ $? -ne 0 ]; then
	echo "Could not install python3 modules - Abort"
	exit 1
fi
