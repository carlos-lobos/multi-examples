#!/bin/bash

# tlds-alpha-by-domain.txt => List of Top Level Domains
# wget https://data.iana.org/TLD/tlds-alpha-by-domain.txt

# Compresion de 1 archivo en otro con nombre tlds.gz, almacenandolo con permisos de root
# Pide password de sudo
bash 01_pack_root_mode.sh root tlds gz tlds-alpha-by-domain.txt
