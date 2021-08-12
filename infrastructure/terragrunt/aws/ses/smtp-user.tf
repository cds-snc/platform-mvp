# IAM user whose credentials will be used to send email through SES
resource "aws_iam_user" "ses_smtp_user" {
  name = "ses_smtp_user"
}

resource "aws_iam_access_key" "ses_smtp_user" {
  user = aws_iam_user.ses_smtp_user.name
}

data "aws_iam_policy_document" "ses_sender" {
  statement {
    actions   = ["ses:SendRawEmail"]
    resources = ["${aws_ses_domain_identity.platform_mvp_sending_domain.arn}*"]
  }
}

resource "aws_iam_policy" "ses_sender" {
  name        = "ses_sender"
  description = "Allows sending email via SES"
  policy      = data.aws_iam_policy_document.ses_sender.json
}

resource "aws_iam_user_policy_attachment" "ses_sender_policy_attach" {
  # checkov:skip=CKV_AWS_40:acceptable to attach policy directly to the user
  user       = aws_iam_user.ses_smtp_user.name
  policy_arn = aws_iam_policy.ses_sender.arn
}
