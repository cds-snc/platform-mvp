resource "aws_route53_zone" "docs_platform_mvp" {
  name = var.domain_name

  tags = {
    (var.billing_tag_key) = var.billing_tag_value
  }
}

resource "aws_route53_record" "docs_platform_mvp_A" {
  zone_id = aws_route53_zone.docs_platform_mvp.zone_id
  name    = aws_route53_zone.docs_platform_mvp.name
  type    = "A"

  alias {
    name                   = aws_api_gateway_domain_name.docs_platform_mvp.regional_domain_name
    zone_id                = aws_api_gateway_domain_name.docs_platform_mvp.regional_zone_id
    evaluate_target_health = false
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
