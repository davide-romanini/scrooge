resource "random_string" "sf_secret" {
  length = 32
}

data "template_file" "docker-compose-tpl" {
  template = "${file("${path.module}/docker-compose.tpl.yml")}"
  vars {
    appversion = "${var.appversion}"
    sf_secret = "${md5(random_string.sf_secret.result)}"
  }
}

resource "google_compute_instance" "scrooge-2" {
  name         = "${var.name}"
  machine_type = "${var.type}"
  zone         = "${var.zone}"

  boot_disk {
    initialize_params {
      type = "pd-standard"
      image = "projects/cos-cloud/global/images/cos-stable-61-9765-79-0"
      size = "${var.disk_size}"
    }
  }

  network_interface {
    network = "default"
    access_config {}
  }

  tags = [
    "http-server"
  ]
}

resource "null_resource" "scrooge-1-deploy" {
  triggers {
    appversion = "${var.appversion}"
  }

  connection {
    host = "${google_compute_instance.scrooge-2.network_interface.0.access_config.0.assigned_nat_ip}"
    private_key = "${file(var.ssh_private_key_path)}"
    user = "${var.ssh_admin_user}"
  }

  provisioner "file" {
    content     = "${data.template_file.docker-compose-tpl.rendered}"
    destination = "/tmp/docker-compose-scrooge.yml"
  }

  provisioner "remote-exec" {
    inline = [
      "docker run --rm -ti -v /var/run/docker.sock:/var/run/docker.sock -v /tmp:/tmp docker/compose:1.16.1 -f /tmp/docker-compose-scrooge.yml up -d",
    ]
  }
}