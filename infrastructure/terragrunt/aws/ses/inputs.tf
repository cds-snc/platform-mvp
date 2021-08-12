variable "route53_zone_id" {
  description = "Route53 zone to create the SES verification and DKIM records in"
  type        = string
}

variable "ses_sending_domain" {
  description = "Domain that will be used by SES to send emails from."
  type        = string
}
