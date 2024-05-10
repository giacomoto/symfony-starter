# Create User Entity
### Create User
```bash
php bin/console make:entity User
```
Add fields email and password

# Install Lexik JWT
### Require composer package
```bash
composer require lexik/jwt-authentication-bundle
```
### Generate keys
```bash
php bin/console lexik:jwt:generate-keypair
```

### Configure `config/packages/lexik_jwt_authentication.yaml`
```yaml
lexik_jwt_authentication:
    token_ttl: '%env(int:JWT_ACCESS_TOKEN_TTL)%'
    secret_key: '%env(resolve:JWT_SECRET_KEY)%'
    public_key: '%env(resolve:JWT_PUBLIC_KEY)%'
    pass_phrase: '%env(JWT_PASSPHRASE)%'
    user_identity_field: id
```

## Update `.env` and `.env.example` file 
```dotenv
# 7 days
JWT_ACCESS_TOKEN_TTL=604800
```

# Install JWTRefreshTokenBundle
### Require composer package
```bash
composer require gesdinet/jwt-refresh-token-bundle
```

### Configure `config/packages/gesdinet_jwt_refresh_token.yaml`
```yaml
gesdinet_jwt_refresh_token:
    refresh_token_class: App\Entity\RefreshToken
    ttl: '%env(int:JWT_REFRESH_TOKEN_TTL)%'
    token_parameter_name: refreshToken
    user_identity_field: '%env(JWT_USER_IDENTITY_FIELD)%'
    single_use: true
```

## Update `.env` and `.env.example` file
```dotenv
# 30 days
JWT_REFRESH_TOKEN_TTL=2592000
JWT_USER_IDENTITY_FIELD=id
```
