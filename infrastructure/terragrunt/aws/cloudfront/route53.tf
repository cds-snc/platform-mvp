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
    name                   = aws_cloudfront_distribution.platform_mvp.domain_name
    zone_id                = aws_cloudfront_distribution.platform_mvp.hosted_zone_id
    evaluate_target_health = false
  }
}
