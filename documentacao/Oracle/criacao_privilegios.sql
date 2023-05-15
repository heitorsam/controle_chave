CREATE USER controle_chave IDENTIFIED BY mangan_ti_usiuso_nga_asno_2023;

GRANT CREATE SESSION TO controle_chave;
GRANT CREATE PROCEDURE TO controle_chave;
GRANT CREATE TABLE TO controle_chave;
GRANT CREATE VIEW TO controle_chave;
GRANT UNLIMITED TABLESPACE TO controle_chave;
GRANT CREATE SEQUENCE TO controle_chave;

GRANT SELECT ON portal_projetos.SEQ_CD_ACESSO TO controle_chave;
GRANT INSERT ON portal_projetos.ACESSO TO controle_chave;

GRANT EXECUTE ON dbasgu.FNC_MV2000_HMVPEP TO controle_chave;

GRANT SELECT ON dbasgu.USUARIOS TO controle_chave;
GRANT SELECT ON dbasgu.PAPEL_USUARIOS TO controle_chave;
