clean :
	rm -f app_checklist
	vagrant destroy

test :  vagrant_up vagrant_provision

vagrant_up :
	vagrant up --no-provision

vagrant_provision :
	rm -rf tmp_roles
	rm -f app_checklist
	mkdir -p tmp_roles
	git clone https://github.com/shaikhfaisal/ansible_php.git tmp_roles/ansible_php
	git clone https://github.com/shaikhfaisal/ansible_postgresql.git tmp_roles/ansible_postgresql
	git clone https://github.com/shaikhfaisal/ansible_nginx.git tmp_roles/ansible_nginx
	ln -s ../ app_checklist
	vagrant provision
	rm -rf tmp_roles
	rm -f app_checklist
