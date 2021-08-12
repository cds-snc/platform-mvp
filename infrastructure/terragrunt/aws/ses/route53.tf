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
