output "api_waf_acl_id" {
  value       = aws_wafv2_web_acl.platform_mvp_api.id
  description = "ID of the WAF ACL for the API"
}

output "cloudfront_waf_acl_id" {
  value       = aws_wafv2_web_acl.platform_mvp_cloudfront.id
  description = "ID of the WAF ACL for the CloudFront distribution"
}
