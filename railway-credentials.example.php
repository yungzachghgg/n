<?php
/*
Railway deployment credentials configuration.
Copy this file to credentials.php and update with your Railway environment variables.
*/

error_reporting(0);

// Railway Database Configuration
$databaseHost = getenv("RAILWAY_PRIVATE_DOMAIN") ?: "localhost";
$databaseUsername = getenv("MYSQLUSER") ?: "root";
$databasePassword = getenv("MYSQLPASSWORD") ?: "";
$databaseName = getenv("MYSQLDATABASE") ?: "main";

$mysqlRequireSSL = false; // Railway handles SSL automatically

// Discord Webhooks (optional)
$logwebhook = getenv("DISCORD_LOG_WEBHOOK") ?: "";
$adminwebhook = getenv("DISCORD_ADMIN_WEBHOOK") ?: "";

// Redis Configuration (if using Railway Redis)
$redisServers = getenv("REDIS_URL") ? [getenv("REDIS_URL")] : [];
$redisPass = getenv("REDIS_PASSWORD") ?: "";

// Discord Bot Token (optional)
$keyauthStatsToken = getenv("DISCORD_BOT_TOKEN") ?: "";

// Webhook Usernames
$webhookun = "KeyAuth Logs";
$adminwebhookun = "KeyAuth Admin Logs";

// AWS SES Configuration (for emails)
$awsAccessKey = getenv("AWS_ACCESS_KEY") ?: "";
$awsSecretKey = getenv("AWS_SECRET_KEY") ?: "";

// Generate Application Secret for Railway
$appSecret = getenv("APP_SECRET") ?: "default-secret-change-in-production";

?>
