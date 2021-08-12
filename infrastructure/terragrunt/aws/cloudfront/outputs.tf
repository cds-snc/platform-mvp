output "domain_name" {
  description = "Domain name 'A' record of the Platform MVP site"
  value       = aws_route53_record.platform_mvp_A.name
}

output "route53_zone_id" {
  description = "Route53 zone ID used to manage the Platform MVP records"
  value       = aws_route53_zone.platform_mvp.zone_id
}
