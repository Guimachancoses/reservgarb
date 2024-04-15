from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException, NoSuchElementException
from time import sleep
import os

class ZapBot:
    # O local de execução do nosso script
    dir_path = os.getcwd()
    
    # Caminho onde será criada pasta profile
    profile = os.path.join(dir_path, fr"C:\Users\agenda\Documents", "wpp")

    def __init__(self):
        self.options = webdriver.ChromeOptions()
        self.options.add_argument("--disable-notifications")
        self.options.add_argument("--start-maximized")
        # self.options.add_argument("--headless")
        # Configurando a pasta profile, para mantermos os dados da seção
        self.options.add_argument(r"user-data-dir={}".format(self.profile))
        # Inicializa o webdriver
        self.driver = webdriver.Chrome(options=self.options)
        # Abre o whatsappweb
        self.driver.get("https://web.whatsapp.com/")
        # Aguarda alguns segundos para validação manual do QrCode
        self.driver.implicitly_wait(60)

    # abrindo a conversa com o contato:
    def abre_conversa(self, contato):
        """ Abre a conversa com um contato especifico """
        try:
            WebDriverWait(self.driver, 40).until(EC.presence_of_element_located((By.CSS_SELECTOR, '[data-icon="new-chat-outline"]')))
            # Seleciona a lista de contatos
            self.lista_de_contato = self.driver.find_element(By.CSS_SELECTOR, '[data-icon="new-chat-outline"]').click()
            sleep(1)
            # Seleciona a caixa de pesquisa de conversa
            self.caixa_de_pesquisa = self.driver.find_element(By.XPATH, '//*[@id="app"]/div/div[2]/div[2]/div[1]/span/div/span/div/div[1]/div[2]/div[2]/div/div[1]')
            # Digita o nome ou numero do contato
            self.caixa_de_pesquisa.send_keys(contato)
            sleep(2)
            # Seleciona o contato
            self.contato = self.driver.find_element(By.XPATH, '//*[@id="app"]/div/div[2]/div[2]/div[1]/span/div/span/div/div[2]/div/div/div/div[2]')
            # Entra na conversa
            self.contato.click()
        except (TimeoutException, NoSuchElementException) as e:
            print("Erro ao abrir conversa:", e)

    # envia mensagens na conversa foi aberta:
    def envia_msg(self, msg):
        """ Envia uma mensagem para a conversa aberta """
        try:
            sleep(5)
            WebDriverWait(self.driver, 40).until(EC.presence_of_element_located((By.XPATH, '//*[@id="main"]/footer/div[1]/div/span[2]/div/div[2]/div[1]/div/div[1]')))
            # Seleciona a caixa de mensagem
            self.caixa_de_mensagem = self.driver.find_element(By.XPATH, '//*[@id="main"]/footer/div[1]/div/span[2]/div/div[2]/div[1]/div/div[1]')
            # Digita a mensagem
            self.caixa_de_mensagem.send_keys(msg)
            sleep(2)
            # Seleciona botão enviar
            WebDriverWait(self.driver, 10).until(EC.presence_of_element_located((By.CSS_SELECTOR, '[data-tab="11"]')))
            self.botao_enviar = self.driver.find_element(By.CSS_SELECTOR, '[data-tab="11"]')
            sleep(2)
            # Envia msg
            self.botao_enviar.click()
            sleep(2)
        except NoSuchElementException as e:
            print("Erro ao enviar msg:", e)
    # função para fechar a conexão e finalizar todo processo:
    def finaliza_processo(self):
        """ Fecha a conexão e finaliza o processo """
        self.driver.quit()
        
    def envia_msg_lista_contatos(self, lista_contatos, mensagem):
        try:     
            # Verifica se a lista de contatos está vazia
            if not lista_contatos:
                # Se estiver vazia, define uma lista de contato padrão
                lista_contatos = ['+55 19 98195-5602']
            """ Envia mensagem para uma lista de contatos """
            for contato in lista_contatos:
                self.abre_conversa(contato)
                sleep(2)
                self.envia_msg(mensagem)
                print(f'mensagem enviada para {contato}')
        except (TimeoutException, NoSuchElementException) as e:
            print("Erro ao enviar msg:", e)

