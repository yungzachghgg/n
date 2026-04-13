# Deploying KeyAuth on Railway

This guide will help you deploy KeyAuth on Railway.com with automatic key generation functionality.

## Quick Setup

### 1. Create Railway Account
- Sign up at [railway.app](https://railway.app)
- Install Railway CLI or use the web interface

### 2. Deploy to Railway

#### Option A: Using Railway CLI
```bash
# Install Railway CLI
npm install -g @railway/cli

# Login to Railway
railway login

# Deploy from project directory
cd KeyAuth-Source-Code-main
railway init
railway up
```

#### Option B: Using GitHub
1. Push your code to GitHub
2. Connect your GitHub account to Railway
3. Select the repository and deploy

### 3. Configure Environment Variables

In your Railway project settings, add these environment variables:

```bash
# Database (automatically provided by Railway)
MYSQLUSER=your_mysql_user
MYSQLPASSWORD=your_mysql_password  
MYSQLDATABASE=main
RAILWAY_PRIVATE_DOMAIN=railway-prod-xxxx.railway.app

# Optional: Discord Webhooks
DISCORD_LOG_WEBHOOK=https://discord.com/api/webhooks/xxxx/xxxx
DISCORD_ADMIN_WEBHOOK=https://discord.com/api/webhooks/xxxx/xxxx

# Optional: Redis (if using Railway Redis addon)
REDIS_URL=redis://default:password@host:port
REDIS_PASSWORD=your_redis_password

# Application Security
APP_SECRET=your_unique_app_secret_here
```

### 4. Setup Database

1. Add a MySQL database to your Railway project
2. Run the database schema:
   - Import `db_structure.sql` into your Railway database
   - Or use Railway's database console to run the SQL

### 5. Configure Credentials

1. Copy `railway-credentials.example.php` to `includes/credentials.php`
2. The file will automatically use Railway environment variables

## Key Generation Features

Your KeyAuth instance on Railway will include:

- **Automatic License Key Generation**: Built-in functions to generate license keys
- **Multiple Key Formats**: Support for custom key masks and formats
- **API Endpoints**: Full API for key generation and validation
- **User Authentication**: Complete user registration and login system
- **Session Management**: Secure session handling with Redis support

## API Endpoints

### Initialize Application
```
POST /api/1.2/index.php
Content-Type: application/x-www-form-urlencoded

type=init&ownerid=YOUR_OWNERID&name=YOUR_APP_NAME
```

### Register User with License Key
```
POST /api/1.2/index.php
Content-Type: application/x-www-form-urlencoded

type=register&sessionid=SESSION_ID&username=USERNAME&key=LICENSE_KEY&pass=PASSWORD&hwid=HWID
```

### Login User
```
POST /api/1.2/index.php
Content-Type: application/x-www-form-urlencoded

type=login&sessionid=SESSION_ID&username=USERNAME&pass=PASSWORD&hwid=HWID
```

### License Key Only Login
```
POST /api/1.2/index.php
Content-Type: application/x-www-form-urlencoded

type=license&sessionid=SESSION_ID&key=LICENSE_KEY&hwid=HWID
```

## Web Panel

Access your KeyAuth admin panel at:
```
https://your-railway-url.railway.app/app/
```

## Troubleshooting

### Database Connection Issues
- Ensure MySQL addon is added to your Railway project
- Check that database credentials match environment variables
- Verify database schema is imported

### Permission Errors
- Railway automatically sets correct file permissions
- If issues occur, redeploy the project

### Performance Issues
- Enable Redis addon for caching
- Consider upgrading to Railway's paid tiers for better performance

## Security Notes

- Change the default `APP_SECRET` environment variable
- Use HTTPS (Railway provides this automatically)
- Regularly update your dependencies
- Monitor your Discord webhooks for security alerts

## Support

For KeyAuth-specific issues:
- Visit [keyauth.cc](https://keyauth.cc)
- Check the documentation in the repository

For Railway deployment issues:
- Check [Railway documentation](https://docs.railway.app)
- Review Railway project logs for errors
