output "api_waf_acl_arn" {
  value       = aws_wafv2_web_acl.platform_mvp_api.arn
  description = "ARN of the WAF ACL for the API"
}

output "cloudfront_waf_acl_arn" {
  value       = aws_wafv2_web_acl.platform_mvp_cloudfront.arn
  description = "ARN of the WAF ACL for the CloudFront distribution"
}
