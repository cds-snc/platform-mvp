variable "dmarc_policy" {
  description = "DMARC policy action to take for emails that fail authentication"
  type        = string

  validation {
    condition     = contains(["none", "quarantine", "reject"], var.dmarc_policy)
    error_message = "Valid values for var: dmarc_policy are: none, quarantine, reject."
  }
}

variable "dmarc_report_email" {
  description = "DMARC destination email address for reports of emails that failed authentication"
  type        = string
}

variable "route53_zone_id" {
  description = "Route53 zone to create the SES verification and DKIM records in"
  type        = string
}

variable "ses_sending_domain" {
  description = "Domain that will be used by SES to send emails from"
  type        = string
}
