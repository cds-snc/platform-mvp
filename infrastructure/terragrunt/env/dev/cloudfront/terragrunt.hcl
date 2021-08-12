include {
  path = find_in_parent_folders()
}

dependencies {
  paths = ["../waf"]
}

dependency "waf" {
  config_path = "../waf"

  mock_outputs_allowed_terraform_commands = ["init", "fmt", "validate", "plan", "show"]
  mock_outputs = {
    cloudfront_waf_acl_arn = ""
  }
}

inputs = {
  cloudfront_waf_acl_arn = dependency.waf.outputs.cloudfront_waf_acl_arn
  domain_name            = "platform.cdssandbox.xyz"
}

terraform {
  source = "../../../aws//cloudfront"
}
