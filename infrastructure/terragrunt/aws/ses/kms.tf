resource "aws_kms_key" "sns" {
  description         = "SNS topic encryption key"
  enable_key_rotation = true
  policy              = data.aws_iam_policy_document.sns_kms_policy.json
}

data "aws_iam_policy_document" "sns_kms_policy" {
  policy_id = "key-policy-sns"
  statement {
    sid = "Enable IAM User Permissions"
    actions = [
      "kms:*",
    ]
    effect = "Allow"
    principals {
      type        = "AWS"
      identifiers = ["arn:aws:iam::${var.account_id}:root"]
    }
    resources = ["arn:aws:kms:${var.region}:${var.account_id}:key/*"]
  }
  statement {
    sid    = "Allow CloudWatch"
    effect = "Allow"
    actions = [
      "kms:GenerateDataKey*",
      "kms:Decrypt"
    ]
    principals {
      type        = "Service"
      identifiers = ["cloudwatch.amazonaws.com"]
    }
    resources = ["arn:aws:kms:${var.region}:${var.account_id}:key/*"]
  }
  statement {
    sid    = "Allow CloudWatch Events"
    effect = "Allow"
    actions = [
      "kms:GenerateDataKey*",
      "kms:Decrypt"
    ]
    principals {
      type        = "Service"
      identifiers = ["events.amazonaws.com"]
    }
    resources = ["arn:aws:kms:${var.region}:${var.account_id}:key/*"]
  }
  statement {
    sid    = "Allow SNS"
    effect = "Allow"
    actions = [
      "kms:GenerateDataKey*",
      "kms:Decrypt"
    ]
    principals {
      type        = "Service"
      identifiers = ["sns.amazonaws.com"]
    }
    resources = ["arn:aws:kms:${var.region}:${var.account_id}:key/*"]
  }
}

resource "aws_kms_alias" "sns" {
  name          = "alias/sns"
  target_key_id = aws_kms_key.sns.key_id
}
