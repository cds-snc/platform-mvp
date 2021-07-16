locals {
  vars = read_terragrunt_config("../env_vars.hcl")
}

inputs = {
  account_id                      = "${local.vars.inputs.account_id}"
  api_name                        = "${local.vars.inputs.api_name}"
  api_stage_name                  = "${local.vars.inputs.api_stage_name}"
  billing_tag_key                 = "${local.vars.inputs.billing_tag_key}"
  billing_tag_value               = "${local.vars.inputs.billing_tag_value}"
  cloudfront_custom_header_name   = "${local.vars.inputs.cloudfront_custom_header_name}"
  cloudfront_custom_header_value  = "${local.vars.inputs.cloudfront_custom_header_value}"
  env                             = "${local.vars.inputs.env}"
  region                          = "ca-central-1"
}

remote_state {
  backend = "s3"
  generate = {
    path      = "backend.tf"
    if_exists = "overwrite_terragrunt"
  }
  config = {
    encrypt        = true
    bucket         = "cds-platform-mvp-${local.vars.inputs.env}-tf"
    dynamodb_table = "terraform-state-lock-dynamo"
    region         = "ca-central-1"
    key            = "${path_relative_to_include()}/terraform.tfstate"
  }
}

generate "provider" {
  path      = "provider.tf"
  if_exists = "overwrite"
  contents  = file("./common/provider.tf")
}

generate "common_variables" {
  path      = "common_variables.tf"
  if_exists = "overwrite"
  contents  = file("./common/common_variables.tf")
}
