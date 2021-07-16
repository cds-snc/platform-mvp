variable "api_name" {
  description = "(Required) name of the Platform MVP REST API"
  type        = string
}

variable "api_stage_name" {
  description = "(Required) name of the Platform MVP REST API stage for the base path mapping"
  type        = string
}

variable "cloudfront_waf_acl_id" {
  description = "(Required) ID of the WAF ACL for the CloudFront distribution"
  type        = string
}

variable "domain_name" {
  description = "(Required) domain name to use for for the Platform MVP CMS project"
  type        = string
}
