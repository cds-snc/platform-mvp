resource "aws_api_gateway_domain_name" "platform_mvp" {
  regional_certificate_arn = aws_acm_certificate.platform_mvp.arn
  domain_name              = var.domain_name
  security_policy          = "TLS_1_2"

  endpoint_configuration {
    types = ["REGIONAL"]
  }

  tags = {
    (var.billing_tag_key) = var.billing_tag_value
  }

  depends_on = [
    aws_acm_certificate_validation.platform_mvp
  ]
}

resource "aws_api_gateway_base_path_mapping" "platform_mvp" {
  domain_name = aws_api_gateway_domain_name.platform_mvp.domain_name
  api_id      = data.aws_api_gateway_rest_api.platform_mvp.id
  stage_name  = var.api_stage_name
}