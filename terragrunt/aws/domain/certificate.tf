resource "aws_acm_certificate" "docs_platform_mvp" {
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

resource "aws_acm_certificate_validation" "docs_platform_mvp" {
  certificate_arn         = aws_acm_certificate.docs_platform_mvp.arn
  validation_record_fqdns = [for record in aws_route53_record.docs_platform_mvp_validation : record.fqdn]
}
