### Ignore trigger while upload


`zcat /home/amitbera/Downloads/staging-dump-03jun.zip | sed -e 's/DEFINER[ ]*=[ ]*[^*]*\*/\*/' | mysql -h 127.0.0.1 -u root -p dbName`
