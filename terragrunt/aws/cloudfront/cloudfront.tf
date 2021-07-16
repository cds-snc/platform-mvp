locals {
  api_id = data.aws_api_gateway_rest_api.platform_mvp.id
}

resource "aws_cloudfront_distribution" "platform_mvp" {

  origin {
    domain_name = "${local.api_id}.execute-api.${var.region}.amazonaws.com"
    origin_path = "/${var.api_stage_name}"
    origin_id   = local.api_id

    custom_header {
      name  = var.cloudfront_custom_header_name
      value = var.cloudfront_custom_header_value
    }

    custom_origin_config {
      http_port              = 80
      https_port             = 443
      origin_protocol_policy = "https-only"
      origin_ssl_protocols   = ["TLSv1.2"]
    }
  }

  enabled         = true
  is_ipv6_enabled = true
  web_acl_id      = var.cloudfront_waf_acl_id

  aliases = [var.domain_name]

  # By default, cache nothing
  default_cache_behavior {
    allowed_methods  = ["GET", "HEAD", "OPTIONS"]
    cached_methods   = ["GET", "HEAD", "OPTIONS"]
    target_origin_id = local.api_id

    forwarded_values {
      query_string = true
      cookies {
        forward = "all"
      }
    }

    viewer_protocol_policy = "redirect-to-https"
    min_ttl                = 0
    default_ttl            = 3600
    max_ttl                = 7200
    compress               = true
  }

  price_class = "PriceClass_100"

  restrictions {
    geo_restriction {
      restriction_type = "none"
    }
  }

  viewer_certificate {
    acm_certificate_arn      = aws_acm_certificate.platform_mvp_cloudfront.arn
    minimum_protocol_version = "TLSv1.2_2021"
    ssl_support_method       = "sni-only"
  }

  logging_config {
    include_cookies = false
    bucket          = aws_s3_bucket.cloudfront_logs.bucket_domain_name
    prefix          = "cloudfront"
  }

  tags = {
    (var.billing_tag_key) = var.billing_tag_value
  }

  depends_on = [aws_s3_bucket.cloudfront_logs]
}
