include {
  path = find_in_parent_folders()
}

inputs = {
  api_name = "dev-aws-node-express-api"
}

terraform {
  source = "../../../aws//waf"
}
