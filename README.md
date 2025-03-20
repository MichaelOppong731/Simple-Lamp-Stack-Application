# ProjectX Documentation

## 1. Overview
ProjectX is a containerized application deployed on AWS, leveraging EC2 instances, Auto Scaling, and Load Balancer for high availability and scalability. It is monitored using AWS CloudWatch, with logs streamed directly from Docker containers.

### **Technologies Used**
- **Docker** for containerization
- **AWS EC2** for instance hosting
- **AWS Auto Scaling Group** for dynamic scaling
- **AWS Load Balancer** for traffic distribution
- **AWS CloudWatch** for logging and monitoring
- **Ubuntu** as the base OS
- **Systemd** for container auto-start

## 2. Infrastructure Setup

### **EC2 Instance Configuration**
1. Launch an Ubuntu EC2 instance.
2. Assign the appropriate IAM role with permissions for CloudWatch logging.
3. Install Docker and CloudWatch Agent.

```bash
sudo apt update -y
sudo apt install -y docker.io amazon-cloudwatch-agent
sudo systemctl enable docker
```

4. Create a custom AMI to ensure consistency across scaled instances.

```bash
aws ec2 create-image --instance-id <instance-id> --name "ProjectX-AMI"
```

### **Auto Scaling & Load Balancer**
1. Create an **Auto Scaling Group (ASG)** linked to the AMI.
2. Attach a **Load Balancer** to the ASG.
3. Set up **Security Groups** to allow HTTP (80) and SSH (22) access.

## 3. Containerization & Deployment

### **Docker Setup**
Build and push the Docker image:
```bash
docker build -t michaelopp/projectx:latest .
docker push michaelopp/projectx:latest
```

### **Running the Container with AWS Logs**
```bash
docker run -d -p 80:80 \
  --log-driver=awslogs \
  --log-opt awslogs-region=eu-west-1 \
  --log-opt awslogs-group=projectx-logs \
  --log-opt awslogs-stream="{{.ID}}" \
  michaelopp/projectx:latest
```

### **Systemd Service for Auto-Start**
Create `/etc/systemd/system/projectx.service`:
```ini
[Unit]
Description=ProjectX Container Service
After=docker.service
Requires=docker.service

[Service]
Restart=always
ExecStartPre=-/usr/bin/docker rm -f projectx_container
ExecStart=/usr/bin/docker run --rm \
    --name projectx_container \
    -p 80:80 \
    --log-driver=awslogs \
    --log-opt awslogs-region=eu-west-1 \
    --log-opt awslogs-group=projectx-logs \
    --log-opt awslogs-stream-format="{{.ID}}" \
    michaelopp/projectx:latest
ExecStop=/usr/bin/docker stop projectx_container

[Install]
WantedBy=multi-user.target
```
Enable and start the service:
```bash
sudo systemctl daemon-reload
sudo systemctl enable projectx.service
sudo systemctl start projectx.service
```

## 4. Monitoring & Logging

### **Docker Logs to AWS CloudWatch**
- Containers use **awslogs** driver to stream logs to CloudWatch.
- Logs appear in **Log Groups > projectx-logs**.

### **Instance Metrics to CloudWatch**
Configure the CloudWatch Agent:
```json
{
  "metrics": {
    "metrics_collected": {
      "cpu": {"measurement": ["cpu_usage_user", "cpu_usage_system"], "metrics_collection_interval": 60},
      "mem": {"measurement": ["mem_used_percent"], "metrics_collection_interval": 60}
    }
  }
}
```
Start the agent:
```bash
sudo amazon-cloudwatch-agent-ctl -a fetch-config -m ec2 -c file:/opt/aws/amazon-cloudwatch-agent/etc/config.json -s
```

## 5. Scaling & High Availability
- Auto Scaling increases/decreases instances based on CPU utilization.
- Load Balancer ensures even traffic distribution.
- All instances auto-run **ProjectX** using the AMI and **systemd**.

## 6. Deployment Steps
1. Build & push the Docker image.
2. Update the Auto Scaling Group to use the latest AMI.
3. Restart the CloudWatch agent if needed.

## 7. Troubleshooting
- Check logs: `docker logs -f projectx_container`
- Check CloudWatch logs: AWS Console > CloudWatch > Log Groups.
- Restart service: `sudo systemctl restart projectx.service`



