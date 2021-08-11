variable "cloudfront_waf_acl_arn" {
  description = "(Required) ARN of the WAF ACL for the CloudFront distribution"
  type        = string
}

variable "domain_name" {
  description = "(Required) domain name to use for for the Platform MVP CMS project"
  type        = string
}
