output "certificate_arn" {
  value = aws_acm_certificate.platform_mvp.arn
}

output "api_gateway_id" {
  value = data.aws_api_gateway_rest_api.platform_mvp.id
}

output "api_gateway_domain_name" {
  value = aws_api_gateway_domain_name.platform_mvp.domain_name
}
