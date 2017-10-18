output "ip" {
  value = "${google_compute_instance.scrooge-2.network_interface.0.access_config.0.assigned_nat_ip}"
}