#
# API: only allow access if the CloudFront custom header exists
#
resource "aws_wafv2_web_acl" "platform_mvp_api" {
  name  = "platform_mvp_api"
  scope = "REGIONAL"

  default_action {
    block {}
  }

  rule {
    name     = "CloudFrontCustomHeader"
    priority = 201

    action {
      allow {}
    }

    statement {
      byte_match_statement {
        positional_constraint = "EXACTLY"
        field_to_match {
          single_header {
            name = var.cloudfront_custom_header_name
          }
        }
        search_string = var.cloudfront_custom_header_value
        text_transformation {
          priority = 1
          type     = "NONE"
        }
      }
    }

    visibility_config {
      cloudwatch_metrics_enabled = true
      metric_name                = "CloudFrontCustomHeader"
      sampled_requests_enabled   = false
    }
  }

  tags = {
    (var.billing_tag_key) = var.billing_tag_value
  }

  visibility_config {
    cloudwatch_metrics_enabled = true
    metric_name                = "platform_mvp_api"
    sampled_requests_enabled   = false
  }
}

#
# CloudFront: use AWS rulesets to block malicious traffic
#
resource "aws_wafv2_web_acl" "platform_mvp_cloudfront" {
  provider = aws.us-east-1

  name  = "platform_mvp_cloudfront"
  scope = "CLOUDFRONT"

  default_action {
    allow {}
  }

  rule {
    name     = "AWSManagedRulesAmazonIpReputationList"
    priority = 1

    override_action {
      none {}
    }

    statement {
      managed_rule_group_statement {
        name        = "AWSManagedRulesAmazonIpReputationList"
        vendor_name = "AWS"
      }
    }

    visibility_config {
      cloudwatch_metrics_enabled = true
      metric_name                = "AWSManagedRulesAmazonIpReputationList"
      sampled_requests_enabled   = true
    }
  }

  rule {
    name     = "AWSManagedRulesCommonRuleSet"
    priority = 2

    override_action {
      none {}
    }

    statement {
      managed_rule_group_statement {
        name        = "AWSManagedRulesCommonRuleSet"
        vendor_name = "AWS"
      }
    }

    visibility_config {
      cloudwatch_metrics_enabled = true
      metric_name                = "AWSManagedRulesCommonRuleSet"
      sampled_requests_enabled   = true
    }
  }

  rule {
    name     = "AWSManagedRulesKnownBadInputsRuleSet"
    priority = 3

    override_action {
      none {}
    }

    statement {
      managed_rule_group_statement {
        name        = "AWSManagedRulesKnownBadInputsRuleSet"
        vendor_name = "AWS"
      }
    }

    visibility_config {
      cloudwatch_metrics_enabled = true
      metric_name                = "AWSManagedRulesKnownBadInputsRuleSet"
      sampled_requests_enabled   = true
    }
  }

  rule {
    name     = "AWSManagedRulesLinuxRuleSet"
    priority = 4

    override_action {
      none {}
    }

    statement {
      managed_rule_group_statement {
        name        = "AWSManagedRulesLinuxRuleSet"
        vendor_name = "AWS"
      }
    }

    visibility_config {
      cloudwatch_metrics_enabled = true
      metric_name                = "AWSManagedRulesLinuxRuleSet"
      sampled_requests_enabled   = true
    }
  }

  rule {
    name     = "AWSManagedRulesSQLiRuleSet"
    priority = 5

    override_action {
      none {}
    }

    statement {
      managed_rule_group_statement {
        name        = "AWSManagedRulesSQLiRuleSet"
        vendor_name = "AWS"
      }
    }

    visibility_config {
      cloudwatch_metrics_enabled = true
      metric_name                = "AWSManagedRulesSQLiRuleSet"
      sampled_requests_enabled   = true
    }
  }

  # Allow up to 10,000 requests for a given IP in a 5 minute period
  rule {
    name     = "RequestRateLimit"
    priority = 6

    action {
      block {}
    }

    statement {
      rate_based_statement {
        limit              = 10000
        aggregate_key_type = "IP"
      }
    }

    visibility_config {
      cloudwatch_metrics_enabled = true
      metric_name                = "RequestRateLimit"
      sampled_requests_enabled   = true
    }
  }

  tags = {
    (var.billing_tag_key) = var.billing_tag_value
  }

  visibility_config {
    cloudwatch_metrics_enabled = true
    metric_name                = "platform_mvp_cloudfront"
    sampled_requests_enabled   = false
  }
}

###
# AWS WAF - Resource Assocation
###
resource "aws_wafv2_web_acl_association" "platform_mvp_api" {
  resource_arn = "${data.aws_api_gateway_rest_api.platform_mvp.arn}/stages/${var.api_stage_name}"
  web_acl_arn  = aws_wafv2_web_acl.platform_mvp_api.arn
}
