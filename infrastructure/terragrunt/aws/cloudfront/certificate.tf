#
# CloudFront certificate, which must be in us-east-1
#

resource "aws_acm_certificate" "platform_mvp_cloudfront" {
  provider = aws.us-east-1

  domain_name               = var.domain_name
  subject_alternative_names = ["*.${var.domain_name}"]
  validation_method         = "DNS"

  tags = {
    (var.billing_tag_key) = var.billing_tag_value
  }

  lifecycle {
    create_before_destroy = true
  }
}

resource "aws_route53_record" "platform_mvp_validation_cloudfront" {
  zone_id = aws_route53_zone.platform_mvp.zone_id

  for_each = {
    for dvo in aws_acm_certificate.platform_mvp_cloudfront.domain_validation_options : dvo.domain_name => {
      name   = dvo.resource_record_name
      record = dvo.resource_record_value
      type   = dvo.resource_record_type
    }
  }

  allow_overwrite = true
  name            = each.value.name
  records         = [each.value.record]
  type            = each.value.type
  ttl             = 60
}

resource "aws_acm_certificate_validation" "platform_mvp_cloudfront" {
  provider                = aws.us-east-1
  certificate_arn         = aws_acm_certificate.platform_mvp_cloudfront.arn
  validation_record_fqdns = [for record in aws_route53_record.platform_mvp_validation_cloudfront : record.fqdn]
}
