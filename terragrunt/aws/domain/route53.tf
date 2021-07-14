resource "aws_route53_zone" "docs_platform_mvp" {
  name = var.domain_name

  tags = {
    (var.billing_tag_key) = var.billing_tag_value
  }
}
