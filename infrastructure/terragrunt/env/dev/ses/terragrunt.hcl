include {
  path = find_in_parent_folders()
}

dependencies {
  paths = ["../cloudfront"]
}

dependency "cloudfront" {
  config_path = "../cloudfront"

  mock_outputs_allowed_terraform_commands = ["init", "fmt", "validate", "plan", "show"]
  mock_outputs = {
    route53_zone_id = ""
    domain_name     = ""
  }
}

inputs = {
  route53_zone_id    = dependency.cloudfront.outputs.route53_zone_id
  ses_sending_domain = dependency.cloudfront.outputs.domain_name
}

terraform {
  source = "../../../aws//ses"
}
