variable "appversion" {
  type = "string"
}

variable "ssh_private_key_path" {
  type = "string"
}

variable "ssh_admin_user" {
  type = "string"
}

variable "name" {
  type = "string"
  description = "Unique name for compute instance"
}

variable "type" {
  type = "string"
  description = "Compute instance type"
  default = "f1-micro"
}

variable "zone" {
  type = "string"
  description = "Compute zone"
  default = "us-west1-b"
}

variable "disk_size" {
  type = "string"
  description = "Boot disk size (must be greater than 10)"
  default = 10
}