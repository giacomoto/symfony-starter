# Virtual Host
```bash
   sudo sh -c "echo '127.0.0.1 test.test' >> /etc/hosts"
```

# Install OpenSSL certificates
```bash
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout docker/nginx-1-25/ssl/nginx-selfsigned.key -out docker/nginx-1-25/ssl/nginx-selfsigned.crt
```

# Start
```bash
. script/docker.sh up
```
