# SES domain identity, verification and custom MAIL FROM domain
resource "aws_ses_domain_identity" "platform_mvp_sending_domain" {
  domain = var.ses_sending_domain
}

resource "aws_ses_domain_dkim" "platform_mvp_domain_dkim" {
  domain = var.ses_sending_domain
}

resource "aws_ses_domain_identity_verification" "platform_mvp_domain_verification" {
  domain     = aws_ses_domain_identity.platform_mvp_sending_domain.id
  depends_on = [aws_route53_record.platform_mvp_ses_verification]
}

resource "aws_ses_domain_mail_from" "platform_mvp_domain_mail_from" {
  domain           = aws_ses_domain_identity.platform_mvp_sending_domain.domain
  mail_from_domain = "mail.${aws_ses_domain_identity.platform_mvp_sending_domain.domain}"
}

# SNS topic that receives bounce, delivery and complaint notifications 
# from to SES email sending
resource "aws_sns_topic" "platform_mvp_ses" {
  name              = "ses-notify"
  kms_master_key_id = aws_kms_alias.sns.name
}

resource "aws_ses_identity_notification_topic" "platform_mvp_ses_bounce_topic" {
  topic_arn                = aws_sns_topic.platform_mvp_ses.arn
  notification_type        = "Bounce"
  identity                 = aws_ses_domain_identity.platform_mvp_sending_domain.arn
  include_original_headers = false
}

resource "aws_ses_identity_notification_topic" "cplatform_mvp_ses_delivery_topic" {
  topic_arn                = aws_sns_topic.platform_mvp_ses.arn
  notification_type        = "Delivery"
  identity                 = aws_ses_domain_identity.platform_mvp_sending_domain.arn
  include_original_headers = false
}

resource "aws_ses_identity_notification_topic" "platform_mvp_ses_complaint_topic" {
  topic_arn                = aws_sns_topic.platform_mvp_ses.arn
  notification_type        = "Complaint"
  identity                 = aws_ses_domain_identity.platform_mvp_sending_domain.arn
  include_original_headers = false
}


