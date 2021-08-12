# DNS SES verification and DomainKeys Identified Mail (DKIM) records
# https://docs.aws.amazon.com/ses/latest/DeveloperGuide/send-email-authentication-dkim.html
resource "aws_route53_record" "platform_mvp_dkim" {
  count = 3

  zone_id = var.route53_zone_id
  name = format(
    "%s._domainkey.%s",
    element(aws_ses_domain_dkim.platform_mvp_domain_dkim.dkim_tokens, count.index),
    var.ses_sending_domain,
  )
  type    = "CNAME"
  ttl     = "600"
  records = ["${element(aws_ses_domain_dkim.platform_mvp_domain_dkim.dkim_tokens, count.index)}.dkim.amazonses.com"]
}

resource "aws_route53_record" "platform_mvp_ses_verification" {
  zone_id = var.route53_zone_id
  name    = "_amazonses.${aws_ses_domain_identity.platform_mvp_sending_domain.id}"
  type    = "TXT"
  ttl     = "600"
  records = [aws_ses_domain_identity.platform_mvp_sending_domain.verification_token]
}

# SPF validation record
# https://docs.aws.amazon.com/ses/latest/DeveloperGuide/send-email-authentication-spf.html
resource "aws_route53_record" "platform_mvp_spf_mail_from" {
  zone_id = var.route53_zone_id
  name    = aws_ses_domain_mail_from.platform_mvp_domain_mail_from.mail_from_domain
  type    = "TXT"
  ttl     = "600"
  records = ["v=spf1 include:amazonses.com -all"]
}

resource "aws_route53_record" "platform_mvp_spf_domain" {
  zone_id = var.route53_zone_id
  name    = var.ses_sending_domain
  type    = "TXT"
  ttl     = "600"
  records = ["v=spf1 include:amazonses.com -all"]
}

# Sending MX Record
resource "aws_route53_record" "platform_mvp_mx_send_mail_from" {
  zone_id = var.route53_zone_id
  name    = aws_ses_domain_mail_from.platform_mvp_domain_mail_from.mail_from_domain
  type    = "MX"
  ttl     = "600"
  records = ["10 feedback-smtp.${var.region}.amazonses.com"]
}

# DMARC Record
# https://docs.aws.amazon.com/ses/latest/DeveloperGuide/send-email-authentication-dmarc.html
resource "aws_route53_record" "platform_mvp_dmarc" {
  zone_id = var.route53_zone_id
  name    = "_dmarc.${var.ses_sending_domain}"
  type    = "TXT"
  ttl     = "600"
  records = ["v=DMARC1; p=${var.dmarc_policy}; rua=mailto:${var.dmarc_report_email};"]
}
