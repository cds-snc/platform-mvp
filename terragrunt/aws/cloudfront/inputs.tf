variable "certificate_arn" {
  description = "(Required) certificate used by CloudFront"
  type        = string
}

variable "domain_name" {
  description = "(Required) domain name to use for CloudFront"
  type        = string
}

variable "origin_id" {
  description = "(Required) ID of the CloudFront Origin"
  type        = string
}