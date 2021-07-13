resource "aws_route53_zone" "docs_platform_mvp" {
  name = var.domain_name

  tags = {
    (var.billing_tag_key) = var.billing_tag_value
  }
}

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

resource "aws_route53_record" "docs_platform_mvp_validation" {
  zone_id = aws_route53_zone.docs_platform_mvp.zone_id

  for_each = {
    for dvo in aws_acm_certificate.docs_platform_mvp.domain_validation_options : dvo.domain_name => {
      name   = dvo.resource_record_name
      type   = dvo.resource_record_type
      record = dvo.resource_record_value

    }
  }

  name    = each.value.name
  records = [each.value.record]
  type    = each.value.type

  ttl = 60
}

resource "aws_acm_certificate_validation" "docs_platform_mvp" {
  certificate_arn         = aws_acm_certificate.docs_platform_mvp.arn
  validation_record_fqdns = [for record in aws_route53_record.docs_platform_mvp_validation : record.fqdn]
}
