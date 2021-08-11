variable "account_id" {
  description = "(Required) The account ID to perform actions on."
  type        = string
}

variable "api_name" {
  description = "(Required) name of the Platform MVP REST API"
  type        = string
}

variable "api_stage_name" {
  description = "(Required) name of the Platform MVP REST API stage for the base path mapping"
  type        = string
}

variable "billing_tag_key" {
  description = "(Required) the key we use to track billing"
  type        = string
}

variable "billing_tag_value" {
  description = "(required) the value we use to track billing"
  type        = string
}

variable "cloudfront_custom_header_name" {
  description = "(Required) custom header added to CloudFront requests to the origin"
  type        = string
  sensitive   = true
}

variable "cloudfront_custom_header_value" {
  description = "(Required) custer header value added to CloudFront requests to the origin"
  type        = string
  sensitive   = true
}

variable "env" {
  description = "(Required) The current running environment"
  type        = string
}

variable "region" {
  description = "(Required) The region to build infra in"
  type        = string
}
