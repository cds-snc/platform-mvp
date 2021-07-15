include {
  path = find_in_parent_folders()
}

dependencies {
  paths = ["../domain"]
}

dependency "domain" {
  config_path = "../domain"

  mock_outputs_allowed_terraform_commands = ["validate", "plan"]
  mock_outputs = {
    certificate_arn         = ""
    api_gateway_domain_name = ""
    api_gateway_id          = ""
  }
}

inputs = {
  certificate_arn = dependency.domain.outputs.certificate_arn
  domain_name     = dependency.domain.outputs.api_gateway_domain_name
  origin_id       = dependency.domain.outputs.api_gateway_id
}

terraform {
  source = "../../../aws//cloudfront"
}