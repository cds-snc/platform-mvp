include {
  path = find_in_parent_folders()
}

dependencies {
  paths = ["../waf"]
}

dependency "waf" {
  config_path = "../waf"

  mock_outputs_allowed_terraform_commands = ["validate", "plan"]
  mock_outputs = {
    cloudfront_waf_acl_id = ""
  }
}

inputs = {
  api_name              = "dev-aws-node-express-api"
  api_stage_name        = "dev"
  cloudfront_waf_acl_id = dependency.waf.outputs.cloudfront_waf_acl_id
  domain_name           = "platform.cdssandbox.xyz"
}

terraform {
  source = "../../../aws//cloudfront"
}
