output "ses_smtp_username" {
  description = "Username for the SMTP IAM user"
  value       = aws_iam_access_key.ses_smtp_user.id
  sensitive   = true
}

output "ses_smtp_password" {
  description = "Password for the SMTP IAM user"
  value       = aws_iam_access_key.ses_smtp_user.ses_smtp_password_v4
  sensitive   = true
}
