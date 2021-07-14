include {
  path = find_in_parent_folders()
}

inputs = {
  api_name       = "dev-aws-node-express-api"
  api_stage_name = "dev"
}

terraform {
  source = "../../../aws//domain"
}
