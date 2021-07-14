resource "aws_api_gateway_domain_name" "docs_platform_mvp" {
  regional_certificate_arn = aws_acm_certificate.docs_platform_mvp.arn
  domain_name              = var.domain_name
  security_policy          = "TLS_1_2"

  endpoint_configuration {
    types = ["REGIONAL"]
  }

  tags = {
    (var.billing_tag_key) = var.billing_tag_value
  }
}

resource "aws_api_gateway_base_path_mapping" "docs_platform_mvp" {
  domain_name = aws_api_gateway_domain_name.docs_platform_mvp.domain_name
  api_id      = data.aws_api_gateway_rest_api.docs_platform_mvp.id
  stage_name  = var.api_stage_name
}