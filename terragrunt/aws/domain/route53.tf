resource "aws_route53_zone" "platform_mvp" {
  name = var.domain_name

  tags = {
    (var.billing_tag_key) = var.billing_tag_value
  }
}

resource "aws_route53_record" "platform_mvp_A" {
  zone_id = aws_route53_zone.platform_mvp.zone_id
  name    = aws_route53_zone.platform_mvp.name
  type    = "A"

  alias {
    name                   = aws_api_gateway_domain_name.platform_mvp.regional_domain_name
    zone_id                = aws_api_gateway_domain_name.platform_mvp.regional_zone_id
    evaluate_target_health = false
  }
}
