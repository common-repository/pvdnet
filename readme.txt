=== Plugin Name ===
Tags: pvdnet, pvd, marketing, digital
Requires at least: 5.0.3
Tested up to: 5.0.3
 
Esse plugin intercepta o envio do contact form 7 para salvar contatos em pvdnet
 
== Description ==

Esse plugin intercepta o envio do contact form 7 para salvar contatos em pvdnet por meio do serviço externo https://pvd.net.br/pvd/api/contatos/store. Trata-se de uma api do Pvd.net, plataforma de automação de marketing digital. Você pode conhecer o Pvd.net no link: https://pvd.net.br. Você pode ler os termos de uso e política de privacidade do pvd.net neste link https://pvd.net.br/pvd/docs/politica
Para enviar os dados para o pvd.net o plugin se utilizada do name dos inputs. Atenção, apesar desse
plugin não criar cookies ele consulta o cookie anteriormente criado pelo Pvd.net e associa essa informação
aos dados digitados com a finalidade de oferecer peças de marketing mais assertivas para o público final do site.

São pesquisados os campos pelos names:
"name" ou "nome" - Para o nome do contato
"tel", "telefone", "fone", "phone", "celular" ou "cel"  - Para o telefone do contato 
"empresa", "company", "companhia" ou "business" - Para o nome da empresa
 
== Installation ==
  
1. Upload `pvdnet.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `&amp;lt;?php do_action('plugin_name_hook'); ?&amp;gt;` in your templates
 
